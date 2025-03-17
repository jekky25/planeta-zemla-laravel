<!--<script setup>
const props = defineProps({
    forInp: {
        default: null,
        type: String,
    }
});
</script>-->

<script>
import TextInput from '@/Components/Forms/TextInput.vue';

export default {
		name: 'LabelInput',
        components: {
			TextInput
		},
		data() {
				return {
				};
			},
        //props : ['id', 'LabelId', 'type', 'name', 'model'],
        props: {
            id: {
                type: String,
                default: null
            },
            LabelId: {
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
      	mounted() {
            //alert(this.$attrs.forInp);
		//	this.for		= 'hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh';
        //alert(this.for);
        this.personal = this.$refs.InputField.model
		},
		methods:
		{
		}
	}
</script>
<template>
    <div class="mb-4">
		<label :id="this.LabelId" :for="this.id"><slot /></label>
			<br />
            <TextInput model="name" :type="this.type" :name="this.name" :id="this.id" ref="InputField"></TextInput>
	</div>
</template>
