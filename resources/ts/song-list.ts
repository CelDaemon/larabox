import {SelectableCollection} from "./selectable-collection";

export class SongList extends SelectableCollection {
    constructor() {
        super();
    }
    getSelectableQuery(): string {
        return "app-song-item";
    }
}
customElements.define("app-song-list", SongList);
