<template>
	<div id="overhtm">
		<div id="overhtm1">
			<div id="overhtm2">
				<div id="header">
					<h1><a :href="route('home')" title="На главную"><img alt="На главную" :src="'../images/logo.png'" /></a></h1>
				</div>
				<div v-if="menuH" id="hmenu">
					<div class="moduletable_menu">
						<ul class="menu">
							<template v-for="item in menuH">
								<li v-if="item.home == true" class="item{{ item.id }}"><a :href="route('home')"><span>{{ item.name }}</span></a></li>
								<li class="item{{ item.id }}" v-else><a :href="route('category.name', item.slug)"><span>{{ item.name }}</span></a></li>
							</template>
						</ul>
					</div>
				</div>
				<div class="main">
					<div class="main1 clearfix">
						<div id="main_content" class="clearfix">
							<div id="main_content1">
								<slot></slot>
							</div>
						</div>
					</div>
				</div>
				<div id="footer">
					<div id="rights">
						<p>копирование материалов разрешено только с установкой обратной ссылки на наш сайт</p>
						<p>&copy; 2010 все права защищены</p>
					</div>
					<div id="feedback">
						<div class="moduletable">
							<ul class="menu">
								<li class="item3"><a :href="route('feedback')"><span>Обратная связь</span></a></li>
							</ul>
						</div>
					</div>
					<div id="counters"></div>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
export default {
    name: "MainLayout",
	data() {
			return {
				menuH: [],
				errors: null
			};
		},
		mounted() {
			this.getMenuH();
		},
		methods:
		{
			getMenuH()
			{
				axios.get('/api/get/menu_h')
				.then(res => {
					this.menuH = res.data;
				})
				.catch(res => {
					this.errors = res;
				});
				return false;
			}
		}
}
</script>