<template>
	<h2 v-if="category">{{ $category.title }}</h2>
	<h2 v-else>Главная</h2>
	<table v-if="posts" class="blog" cellpadding="0" cellspacing="0">
		<tr valign="top">
			<td>
				<div  v-for="post in posts">
					<div class="contentpaneopen">
						<h2 class="contentheading"><a :href="route('item.name', [post.category.slug, post.id, post.slug])" class="contentpagetitle">{{ post.title }}</a></h2>
						<div class="article-content"><span v-html="post.introtext"></span>
							<div class="jcomments-links">
								<a class="readmore-link" :href="route('item.name', [post.category.slug, post.id, post.slug])" :title="post.title">Подробнее...</a>
								<a v-if="post.comments.length > 0" :href="`${route('item.name',[post.category.slug, post.id, post.slug])}#comments`" class="comments-link">Комментарии ({{ post.comments.length }})</a>
								<a v-else :href="`${route('item.name',[post.category.slug, post.id, post.slug])}#addcomments`" class="comments-link">Добавить комментарий</a>
							</div>
						</div>
					</div>
					<span class="article_separator">&nbsp;</span>
				</div>
			</td>
		</tr>
	</table>
</template>

<script>
import MainLayout from '@/Layouts/MainLayout.vue';

export default {
	name: "Index",
	layout: MainLayout,
	props: [
		'Posts'
	],
	data() {
			return {
				posts: [],
				errors: null
			};
	},
	mounted() {
			this.getPosts();
	},
    methods:
	{
		getPosts()
		{
			axios.get('/api/get/posts')
			.then(res => {
				this.posts = res.data;
			})
			.catch(res => {
			this.errors = res;
			});
			return false;
		}
	}
} 
    

</script>