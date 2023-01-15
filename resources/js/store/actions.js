import Columns from "../Requests/Columns";

export default {
    /**
     * update all columns
     * @param {*} payload
     */
    UPDATE_COLUMNS({ commit, state }, payload) {
        commit("UPDATE_COLUMN", payload);
    },

    /**
     *  edit the selected card
     * @param {*} payload
     */
    EDIT_CARD({ commit, state }, payload) {
        commit("EDIT_CARD", payload);
    },

    /**
     * update the selected card
     * @param {*} payload
     */
    UPDATE_CARD({ commit, state }, payload) {
        commit("UPDATE_CARD", payload);
    },

    /**
     * get all columns by filters
     * @param {*} payload
     * @returns
     */
    GET_ALL_COLUMNS({ commit, state }, payload) {
        return Columns.getColumns(payload).then(({ status, data }) => {
            commit("SET_COLUMNS", data.data);
        });
    },

    /**
     * create a column
     * @param {*} payload
     * @returns
     */
    CREATE_COLUMN({ commit, state }, payload) {
        return Columns.create(payload).then(({ status, data }) => {
            if (status !== 200) {
                return console.error("couldn't create column");
            }

            if (data) {
                commit("SET_NEWLY_CREATED_COLUMN", data);
            }
        });
    },

    /**
     * delete a column
     * @param {*} payload
     * @returns
     */
    DELETE_COLUMN({ commit, state }, payload) {
        return Columns.delete(payload).then(({ status, data }) => {
            if (status !== 200) {
                return console.error("couldn't delete column");
            }
        });
    },

    /**
     * save all columns
     * @param {*} payload
     * @returns
     */
    SAVE_COLUMNS({ commit, state }, payload) {
        return Columns.storeColumns({ data: state.columns }).then(
            ({ status, data }) => {
                if (status !== 200) {
                    return console.error("couldn't save columns");
                }
            }
        );
    },
};
