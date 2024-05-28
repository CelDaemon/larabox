import {Selectable} from "./selectable";
export abstract class SelectableCollection extends HTMLElement {
    private previousIndex?: number
    private selectables: Selectable[] = [];
    private selected = new Set<Selectable>();
    protected query = "app-selectable";
    private observer = new MutationObserver(this.querySelectables);
    protected constructor() {
        super();
    }
    public connectedCallback() {
        this.addEventListener("click", this.clickedCallback);
        this.addEventListener("keydown", this.keydownCallback);
        this.observer.observe(this, {subtree: true, childList: true});
        this.querySelectables();
    }
    public disconnectedCallback() {
        this.removeEventListener("click", this.clickedCallback);
        this.removeEventListener("keydown", this.keydownCallback);
        this.observer.disconnect();
    }
    private clickedCallback(event: MouseEvent) {
        if(!(event.target instanceof Selectable)) return;
        const index = this.selectables.indexOf(event.target);
        if(event.shiftKey) {
            if(this.previousIndex !== undefined) this.selectBetween(this.previousIndex, index);
        } else if(event.ctrlKey) {
            this.toggleSelect(event.target);
        } else {
            this.deselectAll();
            this.select(event.target);
        }
        this.previousIndex = index;
    }
    private keydownCallback(event: KeyboardEvent) {
        let reverse;
        if(event.code === "ArrowDown") {
            reverse = false;
        } else if(event.code === "ArrowUp") {
            reverse = true;
        } else {
            return;
        }
        event.preventDefault();
        event.stopPropagation();
        let nextIndex: number;
        if(this.previousIndex === undefined) {
            nextIndex = !reverse ? 0 : this.selectables.length - 1;
        } else {
            const index = this.previousIndex + (!reverse ? 1 : -1);
            if(!reverse && index > this.selectables.length - 1) return;
            if(reverse && index < 0) return;
            nextIndex = index;
        }
        this.previousIndex = nextIndex;
        if(!event.shiftKey) this.deselectAll();
        const nextElement = this.selectables[nextIndex];
        this.select(nextElement);
        nextElement.focus();
    }
    select(...selectables: Selectable[]) {
        for(const selectable of selectables) {
            this.selected.add(selectable);
            selectable.selected = true;
        }
    }
    deselect(...selectables: Selectable[]) {
        for(const selectable of selectables) {
            this.selected.delete(selectable);
            selectable.selected = false;
        }
    }
    toggleSelect(selectable: Selectable) {
        selectable.selected = !selectable.selected;
        if(selectable.selected) this.selected.add(selectable);
        else this.selected.delete(selectable);
    }
    deselectAll() {
        this.deselect(...this.selected);
    }
    selectAll() {
        this.select(...this.selectables);
    }
    selectBetween(begin: number, end: number) {
        this.select(...this.selectables.slice(begin < end ? begin + 1 : end, end > begin ? end + 1 : begin));
    }
    querySelectables() {
        this.selectables = [...(this.querySelectorAll(this.getSelectableQuery()) as NodeListOf<Selectable>)];
    }
    getClosestSelectable(element: HTMLElement): Selectable {
        return element.closest(this.getSelectableQuery()) as Selectable;
    }
    abstract getSelectableQuery(): string;

}
