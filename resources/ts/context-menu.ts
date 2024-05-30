export interface ContextMenuOption {
    title: string;
    action: () => void
}
export class ContextMenu extends HTMLElement {
    connectedCallback() {
        const container = this.shadowRoot?.querySelector("div");
        if(!container) throw new Error();
        document.body.addEventListener("contextmenu", evt => {
            const x = evt.pageX;
            const y = evt.clientY < (window.innerHeight / 2) ? evt.pageY : evt.pageY - this.clientHeight;
            this.style.left = `${x}px`;
            this.style.top = `${y}px`;
            this.style.display = "block";
            while(container.firstElementChild) container.removeChild(container.firstElementChild);
            for(const option of evt.options ?? []) {
                const button = document.createElement("div");
                button.setAttribute("tabindex", "-1");
                button.innerText = option.title;
                button.addEventListener("click", this.optionCallback(option.action));
                container.appendChild(button);
            }
            (container.lastElementChild as HTMLElement).focus();
            evt.preventDefault();
        });
        this.addEventListener("focusout", () => {
            this.style.display = "none";
        })
    }
    optionCallback(action: () => void) {
        return () => {
            this.style.display = "none";
            action();
            return
        }
    }
}

customElements.define("app-context-menu", ContextMenu);
