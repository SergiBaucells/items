<template>
    <div>
        Items example: {{data}}
    </div>
</template>

<style>

</style>

<script>
  export default {
    name: 'items-example',
    data() {
      return {
        data: 'example'
      }
    },
    mounted() {
      console.log('Mounted ok')
    }
  }
</script>
