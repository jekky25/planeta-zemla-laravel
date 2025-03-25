<script>
import TextInput from '@/Components/Forms/TextInput.vue';

export default {
		name: 'LabelInput',
        components: {
			TextInput
		},
		data() {
				return {
                    inputName:'',
                    data: Object
				};
                
			},
        props: {
            id: {
                type: String,
                default: null
            },
            type: {
                type: String,
                default: null
            },
            name: {
                type: String,
                default: null
            },
            model: {
                type: String,
                default: null
            },

        },
		methods:
		{
            get()
            {
                return this.inputName;
            }
		}
	}
</script>
<template>
    <div class="mb-4">
		<label :for="this.id"><slot /></label>
			<br />
            <TextInput v-model="inputName" :type="this.type" :name="this.name" :id="this.id" ref="InputField"></TextInput>
	</div>
</template>
