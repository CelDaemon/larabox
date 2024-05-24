import {SelectableItem} from "./selectable-item.js";

export class SelectableList extends HTMLElement {
    /**
     * @type {SelectableItem[]}
     * @private
     */
    _selectableItems
    /**
     * @type {Set<SelectableItem>}
     * @private
     */
    _selectedItems = new Set();

    /**
     * @type {number|null}
     */
    _previousIndex= null

    constructor() {
        super();
    }
    connectedCallback() {
        this._selectableItems = [...this.querySelectorAll("selectable-item")];
        this.addEventListener("selectable-select", this._selectCallback);
        this.addEventListener("focusout", this._focusoutCallback)
    }

    /**
     * @param {FocusEvent} event
     * @private
     */
    _focusoutCallback(event) {
        if(this.contains(event.relatedTarget) || (event.relatedTarget !== null && event.relatedTarget.matches(this.getAttribute("keep")))) return;
        for(const item of this._selectedItems) {
            item.selected = false;
        }
        this._selectedItems.clear();
    }
    /**
     *
     * @param {SelectEvent} event
     * @private
     */
    _selectCallback(event) {
        const index = this._selectableItems.indexOf(event.target)
        switch (event.detail) {
            case "normal":
                for(const item of this._selectedItems) {
                    if(item !== event.target) item.selected = false;
                }
                this._selectedItems.clear();
                this._selectedItems.add(event.target);
                break;
            case "toggle":
                if(event.target.selected) this._selectedItems.add(event.target);
                else this._selectedItems.delete(event.target);
                break;
            case "bulk":
                let distance = index - this._previousIndex;
                const reverse = distance < 0;
                distance = Math.abs(distance);
                for(let i = 0; i < distance; i++) {
                    const selectable = this._selectableItems[this._previousIndex + (reverse ? -(i + 1) : (i + 1))];
                    selectable.selected = true;
                    this._selectedItems.add(selectable);
                }
                break;
        }
        this._previousIndex = index;
    }
}
customElements.define("selectable-list", SelectableList);
