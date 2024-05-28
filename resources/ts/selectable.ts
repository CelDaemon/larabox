export abstract class Selectable extends HTMLElement {
    private static formAssociated = true;
    private readonly internals: ElementInternals;
    protected constructor() {
        super();
        this.internals = this.attachInternals();
        this.tabIndex = -1;
    }
    set selected(selected: boolean) {
        this.dataset.selected = selected.toString();
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
        return this.dataset.selected === "true";
    }
}
