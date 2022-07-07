function foo() {
	let data = {
		"id": gV(gI("id")),
		"situacao_registro": gV(gI("situacao_registro")),
		"coresInput": {
			"id": gV(gI("cor"))
		}
	};
	request("POST", dv_gateway + "/situacoes_registros", "", data, "controllerResponse", true, getCookie(gz_project));
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
				"label": "situacao_registro",
				"type": "input",
				"id": "situacao_registro",
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