function foo() {
	let data = {
		"id": gV(gI("id")),
		"tela": gV(gI("tela")),
		"identificador": gV(gI("identificador")),
		"menusInput": {
			"id": gV(gI("menu"))
		}
	};
	request("POST", dv_gateway + "/telas", "", data, "controllerResponse", true, getCookie(gz_project));
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
				"label": "tela",
				"type": "input",
				"id": "tela",
				"class": "dv-required"
			}
		],
		[
			{
				"label": "identificador",
				"type": "input",
				"id": "identificador",
				"class": "dv-required"
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
		]
	]
}