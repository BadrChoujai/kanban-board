<template>
    <div v-if="!$store.state.columns.length" class="simple-text nothing-found">
        <span>
            {{ "No Columns Found, Create new ones to view them. :)" }}
        </span>
    </div>
</template>

<script>
export default {
    data() {
        return {};
    },
};
</script>
<style lang="scss" scoped>
img {
    max-width: 120px;
    max-height: 120px;
}
span {
    font-weight: bold;
}
.simple-text {
    display: flex;
    justify-content: center;
    align-items: center;
}
.nothing-found {
    margin-top: 15%;
    border: 1px solid;
    border-radius: 7px;
    border-style: dashed;
    border-color: gray;
    background-color: blanchedalmond;
    padding: 25px;
    width: 50%;
    display: flex;
    justify-content: center;
}
</style>
