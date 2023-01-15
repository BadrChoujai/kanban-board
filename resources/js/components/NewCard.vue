<template>
    <div>
        <div class="m-4">
            <div class="form-group m-2">
                <label for="title">Title:</label>
                <input
                    v-model="currentModalCard.title"
                    class="form-control"
                    type="text"
                    id="title"
                    name="title"
                />
            </div>

            <div class="form-group m-2">
                <label for="description">Description:</label>
                <textarea
                    v-model="currentModalCard.description"
                    class="form-control"
                    id="description"
                    name="description"
                ></textarea>
            </div>
            <button
                class="btn-create-update m-2"
                @click="createOrUpdate"
                :disabled="!currentModalCard.title"
            >
                {{ actionIsCreate ? "Create Card" : "Update Card" }}
            </button>
        </div>
    </div>
</template>

<script>
import { mapActions, mapState } from "vuex";

export default {
    data() {
        return {
            colId: this.$store.state.selectedColumnId,
        };
    },
    beforeDestroy() {
        this.$store.state.currentModalCard = {
            id: 0,
            title: "",
            description: "",
        };
    },
    computed: {
        ...mapState({
            actionIsCreate: (state) => state.actionIsCreate,
        }),
        currentModalCard: {
            get() {
                return this.$store.state.currentModalCard;
            },
            set(val) {
                this.$store.state.currentModalCard = val;
            },
        },
    },
    methods: {
        ...mapActions(["UPDATE_COLUMNS", "UPDATE_CARD"]),
        createOrUpdate() {
            this.currentModalCard.id =
                !this.currentModalCard.id || this.currentModalCard.id === 0
                    ? Math.random()
                    : this.currentModalCard.id;

            if (this.actionIsCreate) {
                this.UPDATE_COLUMNS({
                    card: this.currentModalCard,
                    colId: this.colId,
                });
            } else {
                this.UPDATE_CARD({
                    colId: this.colId,
                    cardId: this.currentModalCard.id,
                    card: this.currentModalCard,
                });
            }

            this.$modal.hide("card");
        },
    },
};
</script>

<style scoped>
.btn-create-update {
    color: black;
    padding: 10px;
    background-color: rgb(255, 247, 235);
    outline: none;
    border-color: lightslategrey;
    border-radius: 5px;
}
</style>
