export default {
    /**
     * update a columns cards
     * @param {*} state
     * @param {*} payload
     */
    UPDATE_COLUMN(state, payload) {
        var cols = state.columns.find(function (element) {
            return element.id === payload.colId;
        });

        cols.cards.push(payload.card);
    },

    /**
     * Set all columns to state
     * @param {*} state
     * @param {*} payload
     */
    SET_COLUMNS(state, payload) {
        state.columns = payload;
    },

    /**
     * edit the selected columns card
     * @param {*} state
     * @param {*} payload
     */
    EDIT_CARD(state, payload) {
        var current = state.columns.find(function (element) {
            return element.id === payload.colId;
        });

        state.currentModalCard = current.cards.find(function (element) {
            return element.id === payload.cardId;
        });
    },

    /**
     * update the selected card
     * @param {*} state
     * @param {*} payload
     */
    UPDATE_CARD(state, payload) {
        var current = state.columns.find(function (element) {
            return element.id === payload.colId;
        });

        let currCard = current.cards.find(function (element) {
            return element.id === payload.cardId;
        });

        currCard = payload.card;
    },

    /**
     *  Set The new create column to state
     * @param {*} state
     * @param {*} payload
     */
    SET_NEWLY_CREATED_COLUMN(state, payload) {
        state.columns.pop();
        state.columns.push(payload);
    },
};
