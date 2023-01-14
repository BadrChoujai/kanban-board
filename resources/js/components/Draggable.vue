<template>
    <div>
        <Draggable
            :list="cards"
            class="list-group"
            draggable=".item"
            group="a"
            @start="dragging = true"
            @end="dragging = false"
        >
            <div
                class="border list-group-item item m-1"
                v-for="card in cards"
                :key="card.id"
            >
                <div class="d-flex justify-content-between align-items-center">
                    <span>
                        {{ card.title }}
                    </span>
                    <div>
                        <font-awesome-icon
                            class="fa-style"
                            @click="edit(card.id)"
                            icon="fas fa-pen"
                        />
                    </div>
                </div>
            </div>
        </Draggable>
    </div>
</template>

<script>
import Draggable from "vuedraggable";
import { mapActions } from "vuex";

export default {
    components: {
        Draggable,
    },
    props: {
        columnId: {
            type: Number,
            default: () => 0,
        },
        cardsList: {
            type: Array,
            default: () => [],
        },
    },
    data() {
        return {
            dragging: true,
            editable: false,
        };
    },
    computed: {
        cards: {
            get() {
                return this.cardsList;
            },
            set(val) {
                this.cardsList = val;
            },
        },
    },
    methods: {
        ...mapActions(["EDIT_CARD"]),
        edit(cardId) {
            this.$store.state.selectedColumnId = this.columnId;
            this.$store.state.actionIsCreate = false;

            this.EDIT_CARD({
                colId: this.columnId,
                cardId,
            });
            this.$modal.show("card");
        },
    },
};
</script>
<style scoped>
.fa-style {
    cursor: pointer;
    margin-left: 5px;
}
</style>
