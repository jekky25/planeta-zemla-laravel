<script setup>
import { inject } from 'vue'
//const { message } = inject('message');
/*
const model = defineModel({
		type: String,
		required: true,
});
*/
import { ref } from 'vue';

defineProps({
  modelValue: {
    type: String,
  }
});
  
defineEmits(['update:modelValue']);


/*
import { provide, ref } from 'vue'

const location = ref('North Pole')

function updateLocation() {
  location.value = 'South Pole'
}

provide('location', {
  location,
  updateLocation
})
*/

</script>
<script>
/*
import { inject } from 'vue'
export default {
		name: 'SecondChild',
		/*
		setup() {
    const message = inject('message')
    return { message }
  }
}
*/
</script>
<template>
    <div>
second child<br />
<!-- input type="text" v-model="model"-->
<input 
  	:value="modelValue"
    @input="$emit('update:modelValue', $event.target.value)"
  >
	</div>
</template>