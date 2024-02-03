<template>
        <div class="dashboard-content-one">
            <div class="breadcrumbs-area">
                <h3>{{ brename }}</h3>
                <ul>

                    <li>
                        <router-link :to="{ name: 'Dashboard' }">{{ brename }}</router-link>
                    </li>

                    <li v-if="secname">
                        <a href="javascript:void(0)">{{ secname }}</a>
                    </li>

                </ul>
            </div>
            </div>
</template>

<script>
export default {
    props: ['brename','secname']
}
</script>
