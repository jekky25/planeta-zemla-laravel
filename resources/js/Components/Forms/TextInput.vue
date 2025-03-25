<script setup>
defineProps({
	modelValue: {
	type: String,
	}
});
defineEmits(['update:modelValue']);
</script>

<template>
	<input
	size="30" 
	class="shadow appearance-none border inputbox rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
	:value="modelValue"
	@input="$emit('update:modelValue', $event.target.value)"
	>
</template>
