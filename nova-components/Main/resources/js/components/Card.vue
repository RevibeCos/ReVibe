<template >
    <Card  style="background-color: rgba(var(--colors-gray-900)) ;" class="flex flex-col items-center justify-center">
      <div class="px-3 py-3">
        <img style="height: 450px;" :src="getImageUrl('logo.png')" alt="Image 1">
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
