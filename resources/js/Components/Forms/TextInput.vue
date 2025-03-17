<script setup>
import { onMounted, ref } from 'vue';

const model = defineModel({
	type: String,
	required: true,
});

//const { changeMessage } = inject('message');

const input = ref(null);

onMounted(() => {
	if (input.value.hasAttribute('autofocus')) {
		input.value.focus();
	}
	//alert(model.name);
//	alert('111');
	console.log(model);
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
	<input
		size="30" 
		class="shadow appearance-none border inputbox rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
		v-model="model"
		ref="input"

	/>
</template>
