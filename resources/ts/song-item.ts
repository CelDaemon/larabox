import {Selectable} from "./selectable";

export class SongItem extends Selectable {
    constructor() {
        super();
    }

}
customElements.define("app-song-item", SongItem);
