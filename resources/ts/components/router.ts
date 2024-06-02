interface Page {
    title: string;
    content: string;
}
export class Router extends HTMLElement {
    private static pushedState = false;
    constructor() {
        super();
    }
    connectedCallback() {
        if(!Router.pushedState) history.replaceState(null, "", location.href);
        Router.pushedState = true;
        window.addEventListener("popstate", this.popstateCallback);
        document.body.addEventListener("click", this.clickedCallback)
    }
    disconnectCallback() {
        window.removeEventListener("popstate", this.popstateCallback);
        document.body.removeEventListener("click", this.clickedCallback);
    }
    async navigate(url: string|URL, push: boolean = true) {
        if(typeof url === "string") url = new URL(url, document.location.href);
        const pageRequest = await fetch(url, {headers: {"Accept": "application/json", "X-Fragment": "content"}});
        if(!pageRequest.ok) this.fullNavigate(url);
        const page = await pageRequest.json() as Page;
        document.title = page.title;
        this.innerHTML = page.content;
        if(push) history.pushState(null, "", url);
    }
    popstateCallback = async () => {
        await this.navigate(location.href, false);
    }
    clickedCallback = async (evt: MouseEvent) => {
        if(!(evt.target instanceof HTMLAnchorElement)) return;
        evt.stopPropagation();
        evt.preventDefault();
        await this.navigate(evt.target.href);
    }
    fullNavigate(url: URL) {
        location.assign(url);
    }
}
customElements.define("lb-router", Router);
