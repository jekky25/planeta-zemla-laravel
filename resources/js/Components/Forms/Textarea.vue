<script setup>
const model = defineModel({
	type: String,
	required: true,
});
</script>
<template>
	<textarea
		class="inputbox required rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline border-transparent focus:border-transparent"
		v-model="model"></textarea>
</template>