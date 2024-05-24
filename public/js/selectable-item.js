/**
 * @typedef {{detail: SelectType, target: SelectableItem}} SelectEvent
 */
/**
 * @typedef {"normal"|"toggle"|"bulk"} SelectType
 */
export class SelectableItem extends HTMLElement {
    static formAssociated = true;
    /**
     * @type {ElementInternals}
     * @private
     */
    _internals
    /**
     * @type {boolean}
     * @private
     */
    _selected
    constructor() {
        super();
        this._internals = this.attachInternals();
        this.tabIndex = 0;
    }
    connectedCallback() {
        this.addEventListener("click", this._clickCallback);
        this.addEventListener("keyup", this._keyupCallback)
    }

    /**
     *
     * @param {SelectType} type
     * @private
     */
    _inputCallback(type) {
        switch (type) {
            case "toggle":
                this.selected = !this.selected;
                break;
            case "bulk":
            default:
                this.selected = true;
                break;
        }
        this.dispatchEvent(new CustomEvent("selectable-select", {detail: type, composed: true, bubbles: true}));
    }

    /**
     * @param {KeyboardEvent} event
     * @private
     */
    _keyupCallback(event) {
        if(event.code !== 'Space') return;
        /**
         * @type {SelectType}
         */
        let type;
        switch (true) {
            case event.ctrlKey:
                type = "toggle";
                break;
            case event.shiftKey:
                type = "bulk";
                break;
            default:
                type = "normal";
                break;
        }
        this._inputCallback(type);
    }
    /**
     *
     * @param {MouseEvent} event
     * @private
     */
    _clickCallback(event) {
        /**
         * @type {SelectType}
         */
        let type;
        switch (true) {
            case event.ctrlKey:
                type = "toggle";
                break;
            case event.shiftKey:
                type = "bulk";
                break;
            default:
                type = "normal";
                break;
        }
        this._inputCallback(type);
    }

    /**
     *
     * @param {boolean} selected
     */
    set selected(selected) {
        this._selected = selected;
        if(selected)
            this._internals.states.add("selected")
        else
            this._internals.states.delete("selected")
        this._internals.setFormValue(selected ? this.getAttribute("value") : null);
    }
    get selected() {
        return this._selected;
    }

}

customElements.define("selectable-item", SelectableItem);
