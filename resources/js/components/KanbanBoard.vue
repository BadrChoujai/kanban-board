<template>
    <div>
        <div class="d-flex m-3 justify-content-between align-items-center">
            <input
                class="column-input form-control"
                type="text"
                @keyup.enter="add"
                v-model="colName"
                placeholder="Press enter to add column"
            />

            <div class="d-flex m-3 justify-content-between align-items-center">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="m-1 d-flex">
                        <select class="form-select" v-model="selectedOption">
                            <option :value="1">Has Cards</option>
                            <option :value="0">Does Not Have Cards</option>
                            <option value="all">All Columns</option>
                        </select>
                    </div>
                    <input
                        class="form-control"
                        style="margin-right: 10px"
                        v-model="created"
                        type="date"
                    />
                </div>

                <font-awesome-icon
                    class="save-button"
                    @click="save"
                    icon="fas fa-save"
                />
            </div>
        </div>

        <div v-if="columns.length" class="columns">
            <div v-for="column in columns" :key="column.id" class="column">
                <div
                    slot="header"
                    class="card-header btn-group list-group-item d-flex justify-content-between align-items-center"
                    role="group"
                >
                    <span>{{ column.title }}</span>
                    <div>
                        <font-awesome-icon
                            class="fa-style"
                            @click="removeColumn(column.id)"
                            icon="fas fa-times"
                        />
                        <font-awesome-icon
                            class="fa-style"
                            @click="toggleModal(column.id)"
                            icon="fas fa-plus"
                        />
                    </div>
                </div>
                <div class="card">
                    <Draggable
                        :columnId="column.id"
                        :cardsList="column.cards"
                    />
                </div>
            </div>
        </div>
        <div v-else>
            <NothingFound />
        </div>
        <modal name="card"><NewCard /></modal>
    </div>
</template>

<script>
import { mapActions, mapMutations } from "vuex";
import Draggable from "./Draggable.vue";
import NewCard from "./NewCard.vue";
import NothingFound from "./NothingFound.vue";
import moment from "moment";
import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";

export default {
    components: {
        Draggable,
        NewCard,
        NothingFound,
    },
    data() {
        return {
            colName: "",
            maxId: 1,
            modalToggled: false,
            action: false,
            created: new Date(),
            selectedOption: "all",
        };
    },
    computed: {
        columns: {
            get() {
                return this.$store.state.columns;
            },
            set(val) {
                this.$store.state.columns = val;
            },
        },
        selectedColumnId: {
            get() {
                return this.$store.state.selectedColumnId;
            },
            set(val) {
                this.$store.state.selectedColumnId = val;
            },
        },
    },
    watch: {
        created: {
            handler() {
                this.fetchData();
            },
            deep: true,
        },
        selectedOption: {
            handler() {
                this.fetchData();
            },
            deep: true,
        },
    },
    created() {
        this.fetchData();
    },
    methods: {
        ...mapActions([
            "GET_ALL_COLUMNS",
            "CREATE_COLUMN",
            "UPDATE_COLUMNS",
            "DELETE_COLUMN",
            "SAVE_COLUMNS",
        ]),
        ...mapMutations(["SET_COLUMNS"]),
        add() {
            if (this.colName.length) {
                let newCol = {
                    id: Math.random(),
                    title:
                        this.colName.charAt(0).toUpperCase() +
                        this.colName.slice(1),
                    created_at: "2021-12-11 22:15:00",
                    cards: [],
                };

                this.columns.push(newCol);
                this.CREATE_COLUMN({
                    data: {
                        title:
                            this.colName.charAt(0).toUpperCase() +
                            this.colName.slice(1),
                    },
                });
            }
        },
        save() {
            this.SAVE_COLUMNS();
            Vue.$toast.success("All Columns Saved!.", {
                position: "top-right",
            });
        },
        resetSelection() {
            this.selectedOption = "all";
        },
        toggleModal(colId) {
            this.$store.state.selectedColumnId = colId;
            this.$store.state.actionIsCreate = true;
            this.$modal.show("card");
        },
        addNewCard(colId) {
            let selectedElement = this.columns.find(function (element) {
                return element.id === colId;
            });

            selectedElement.cards.push({
                id: Math.random(),
                title: Math.random().toString(36).substring(2, 15),
                description: Math.random().toString(76).substring(2, 7),
            });
        },
        removeColumn(id) {
            let index = this.columns.findIndex((element) => element.id === id);

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    this.columns.splice(index, 1);
                    this.DELETE_COLUMN(id);

                    Swal.fire(
                        "Deleted!",
                        "Column has been deleted.",
                        "success"
                    );
                }
            });
        },
        // Make an API call to fetch the columns and cards data
        fetchData() {
            this.GET_ALL_COLUMNS({
                filters: {
                    created_at: moment(this.created).format("L"),
                    cards_status: this.selectedOption,
                },
            });
        },
    },
};
</script>

<style scoped>
.column-input {
    padding: 10px 16px;
    margin: 6px 0;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 14px;
    max-width: 220px;
}

.columns {
    background-color: white;
    border: 1px solid #ddd;
    border-radius: 7px;
    padding: 10px;
    overflow: hidden;
    outline-style: black;
    display: flex;
    margin: 10px;
}

.column {
    flex: 1;
    margin: 10px;
    border-radius: 7px;
}

.card {
    width: 100%;
    display: flex;
    justify-content: space-between;
    border-radius: 7px;
    padding: 10px;
    margin-bottom: 10px;
    background-color: #fff;

    min-width: 168px;
}
.card-header {
    font-weight: bold;
    padding: 10px;
    background-color: #f9f9f9;
}
.fa-style {
    cursor: pointer;
    margin-left: 5px;
}
.save-button {
    cursor: pointer;
    width: 30px;
    height: 30px;
    color: rgb(0, 0, 0);
    margin-right: 5px;
}
</style>
