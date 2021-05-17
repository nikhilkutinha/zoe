<template>
  <div class="bg-white shadow-md rounded-sm border border-gray-250">
    <header class="py-4 px-5 border-b border-gray-250">
      <slot name="header" />
    </header>
    <div>
      <slot />
    </div>
  </div>
</template>
