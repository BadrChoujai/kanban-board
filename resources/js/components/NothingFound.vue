<template>
    <div class="m-4 d-flex justify-content-center align-items-center h-100">
        <img src="../images/nothing-found.svg" />
        <span> No Columns Found, Create new ones to view them. </span>
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
</style>
