export class DialogButton extends HTMLButtonElement {
    constructor() {
        super();
    }
    connectedCallback() {
        this.addEventListener("click", () => {
            let dialog: HTMLElement = document.getElementById(this.dataset.for);
            if(!(dialog instanceof HTMLDialogElement))
                throw new Error(`Element selected by 'data-for' attribute is not of type HTMLDialogElement`);
            dialog.showModal();
        })
    }
}
customElements.define("dialog-button", DialogButton, {extends: "button"})
