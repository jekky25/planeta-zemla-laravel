<template>
	<Head v-if="post" :title="`${post.title} Земля как планета`" />
	<template v-if="post">
		<div class="componentheading"></div>
		<h2 v-if="post.category" class="contentheading"><Link :href="route('item.name',[post.category.slug, post.id, post.slug])" class="contentpagetitle">{{ post.title }}</Link></h2>
		<div class="article-content"><span v-html="post.introtext"></span><span v-html="post.fulltext"></span></div>
		<Comments :post="post"></Comments>
	</template>
</template>
<script>
	import MainLayout from '@/Layouts/MainLayout.vue';
	import {Link} from '@inertiajs/vue3';
	import Comments from '@/Components/Comments.vue';

	export default {
		name: "Page",
		components: {
			Link,
			Comments
		},
		layout: MainLayout,
		props: [
			'post',
		]
	}
</script>