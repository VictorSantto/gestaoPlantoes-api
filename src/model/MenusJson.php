function foo() {
	let data = {
		"id": gV(gI("id")),
		"menu": gV(gI("menu")),
		"link": gV(gI("link")),
		"ordem": gV(gI("ordem")),
		"tipos_menusInput": {
			"id": gV(gI("tipo_menu"))
		},
		"situacoes_registrosInput": {
			"id": gV(gI("situacao_registro"))
		}
	};
	request("POST", dv_gateway + "/menus", "", data, "controllerResponse", true, getCookie(gz_project));
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
				"label": "menu",
				"type": "input",
				"id": "menu",
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
				"label": "tipo_menu",
				"type": "select",
				"id": "tipo_menu",
				"class": "dv-required",
				"options": [
					{
						"value": 1,
						"content": "tipo_menu 1"
					},
					{
						"value": 2,
						"content": "tipo_menu 2"
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