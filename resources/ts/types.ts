import {ContextMenuOption} from "./context-menu";

declare global {
    interface ElementInternals {
        states: Set<string>
    }
    interface MouseEvent {
        options?: ContextMenuOption[]
    }
}
