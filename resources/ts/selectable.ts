export abstract class Selectable extends HTMLElement {
    private static formAssociated = true;
    private readonly internals: ElementInternals;
    private _selected: boolean = false;
    protected constructor() {
        super();
        this.internals = this.attachInternals();
        this.tabIndex = -1;
    }
    set selected(selected: boolean) {
        this._selected = selected;
        if(selected) {
            if(this.dataset.value !== undefined) {
                const data = new FormData();
                data.set(this.dataset.value, this.dataset.value);
                this.internals.setFormValue(data);
            }
            this.internals.states.add("selected");
        }
        else {
            this.internals.setFormValue(null);
            this.internals.states.delete("selected");
        }
    }
    get selected() {
        return this._selected;
    }
}
