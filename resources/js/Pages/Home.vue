<template>
	<h2 v-if="category">{{ $category.title }}</h2>
	<h2 v-else>Главная</h2>
	<table v-if="posts" class="blog" cellpadding="0" cellspacing="0">
		<tr valign="top">
			<td>
				<div  v-for="post in posts">
					<div class="contentpaneopen">
						<h2 class="contentheading"><Link v-if="post.category" :href="route('item.name', [post.category.slug, post.id, post.slug])" class="contentpagetitle">{{ post.title }}</Link></h2>
						<div class="article-content"><span v-html="post.introtext"></span>
							<div v-if="post.category" class="jcomments-links">
								<Link class="readmore-link" :href="route('item.name', [post.category.slug, post.id, post.slug])" :title="post.title">Подробнее...</Link>
								<Link v-if="post.comments.length > 0" :href="`${route('item.name',[post.category.slug, post.id, post.slug])}#comments`" class="comments-link">Комментарии ({{ post.comments.length }})</Link>
								<Link v-else :href="`${route('item.name',[post.category.slug, post.id, post.slug])}#addcomments`" class="comments-link">Добавить комментарий</Link>
							</div>
						</div>
					</div>
					<span class="article_separator">&nbsp;</span>
				</div>
			</td>
		</tr>
		<tr v-if="pagination && pagination.length > 3">
			<td valign="top" align="center">
				<br><br>
				<table class="pagination">
					<tr>
						<td v-for="(_pagination, k) in pagination">
							<span v-if="_pagination.active == 1" v-html="_pagination.label"></span>
							<strong v-else><Link :href="_pagination.url" v-html="_pagination.label"></Link></strong>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</template>

<script>
import MainLayout from '@/Layouts/MainLayout.vue';
import {Link} from '@inertiajs/vue3';
export default {
	name: "Index",
	components: {
		Link
	},
	layout: MainLayout,
	props: [
		'posts',
		'pagination'
	],
	data() {
			return {
				errors: null
			};
	}
} 
</script>