import axios from "axios";
const baseUrl = window.location.origin;
const Resource = baseUrl + "/api/columns";

export default {
    /**
     * Get Columns.
     */
    async getColumns(payload) {
        return axios.get(
            `${Resource}?created_at=${payload.filters.created_at}&cards_status=${payload.filters.cards_status}`,
            payload
        );
    },

    /**
     * Get a column Cards
     */
    getColumnCards({ payload }) {
        return axios.get(`${Resource}/cards`, payload);
    },

    /**
     * store column Cards
     */
    storeColumns(payload) {
        return axios.post(`${Resource}/storeColumns`, payload);
    },

    /**
     * Store a column.
     */
    create(payload) {
        return axios.post(`${Resource}/store`, payload);
    },

    /**
     * Delete a column.
     */
    delete(id) {
        return axios.delete(`${Resource}/delete/${id}`);
    },
};
