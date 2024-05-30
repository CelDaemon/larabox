import {SelectableCollection} from "./selectable-collection";

export class SongList extends SelectableCollection {
    constructor() {
        super();
        this.addEventListener("contextmenu", evt => {
            evt.options = [
                {
                    title: "Option 1",
                    action: this.option1.bind(this)
                },
                {
                    title: "Option 2",
                    action: this.option2
                },
                {
                    title: "Option 3",
                    action: this.option3
                }
            ]
        })
    }
    option1() {
        console.log("Option 1")
        for(const song of this.selected) {
            console.log(song.shadowRoot!.querySelectorAll("div")[1].children[0].textContent)
        }
    }
    option2() {
        console.log("Option 2")
    }
    option3() {
        console.log("Option 3")
    }
    getSelectableQuery(): string {
        return "app-song-item";
    }
}
customElements.define("app-song-list", SongList);
