<template>
    <Card class="w-f flex flex-col items-center justify-center">
      <div class="px-3 py-3">
        <!-- Image placeholders -->
        <img :src="getImageUrl('logo.png')" alt="Image 1">
      </div>
    </Card>
  </template>

  <script>
  export default {
    props: [
      'card',
      // The following props are only available on resource detail cards...
      // 'resource',
      // 'resourceId',
      // 'resourceName',
    ],
    methods: {
        getImageUrl(fileName) {
      return '/images/' + fileName;
    },
    },
  };
  </script>
