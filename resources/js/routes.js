import KanbanBoard from "./components/KanbanBoard.vue";
import NotFound from "./components/NotFound.vue";

export const routes = [
    {
        name: "KanbanBoard",
        path: "/kanban-board",
        component: KanbanBoard,
    },
    {
        path: "*",
        component: NotFound,
        beforeEnter: (to, from, next) => {
            next("/kanban-board");
        },
    },
];
