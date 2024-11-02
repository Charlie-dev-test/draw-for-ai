<template>
  <div id="getApiData" class="container">
    <div class="row data">
      <div class="title">
        Get API Data ({{ dsSamples.length }})
      </div>

      <div class="col">
        <li
          v-for="sample in dsSamples"
          :key="sample.id"
          :title="sample.title"
        >
          {{ sample.title }} (id={{ sample.id }})
        </li>
      </div>
    </div>

  </div>
</template>

<script>
  export default {
    name: "GetApiData",
    props: ['dsSamples'],
    components: {},
    data() {
      return {}
    },
    computed: {},
    methods: {},
    async mounted() {
    }
  }

</script>

<style lang="scss" scoped>
  .data {
    border: 1px solid #999;
    width: 300px;
    margin: 0 auto;
    padding: 10px;
  }
  .data .title {
    font-weight: bold;
    text-decoration: underline;
    font-size: 20px;
  }
</style>
