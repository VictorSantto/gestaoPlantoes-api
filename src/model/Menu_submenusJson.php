function foo() {
	let data = {
		"id": gV(gI("id")),
		"menu_submenu": gV(gI("menu_submenu")),
		"link": gV(gI("link")),
		"ordem": gV(gI("ordem")),
		"menusInput": {
			"id": gV(gI("menu"))
		},
		"situacoes_registrosInput": {
			"id": gV(gI("situacao_registro"))
		}
	};
	request("POST", dv_gateway + "/menu_submenus", "", data, "controllerResponse", true, getCookie(gz_project));
}
			
{
	"form": [
		[
			{
				"label": "id",
				"type": "input",
				"id": "id",
				"class": "dv-integer dv-required"
			}
		],
		[
			{
				"label": "menu_submenu",
				"type": "input",
				"id": "menu_submenu",
				"class": "dv-required"
			}
		],
		[
			{
				"label": "link",
				"type": "input",
				"id": "link",
				"class": "dv-required"
			}
		],
		[
			{
				"label": "ordem",
				"type": "input",
				"id": "ordem",
				"class": "dv-integer dv-required"
			}
		],
		[
			{
				"label": "menu",
				"type": "select",
				"id": "menu",
				"class": "dv-required",
				"options": [
					{
						"value": 1,
						"content": "menu 1"
					},
					{
						"value": 2,
						"content": "menu 2"
					}
				]
			}
		],
		[
			{
				"label": "situacao_registro",
				"type": "select",
				"id": "situacao_registro",
				"class": "dv-required",
				"options": [
					{
						"value": 1,
						"content": "situacao_registro 1"
					},
					{
						"value": 2,
						"content": "situacao_registro 2"
					}
				]
			}
		]
	]
}