function foo() {
	let data = {
		"id": gV(gI("id")),
		"tipo_permissao": gV(gI("tipo_permissao")),
		"coresInput": {
			"id": gV(gI("cor"))
		}
	};
	request("POST", dv_gateway + "/tipos_permissoes", "", data, "controllerResponse", true, getCookie(gz_project));
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
				"label": "tipo_permissao",
				"type": "input",
				"id": "tipo_permissao",
				"class": "dv-required"
			}
		],
		[
			{
				"label": "cor",
				"type": "select",
				"id": "cor",
				"class": "dv-required",
				"options": [
					{
						"value": 1,
						"content": "cor 1"
					},
					{
						"value": 2,
						"content": "cor 2"
					}
				]
			}
		]
	]
}