function foo() {
	let data = {
		"id": gV(gI("id")),
		"cor": gV(gI("cor")),
		"hexadecimal": gV(gI("hexadecimal")),
		"tipos_coresInput": {
			"id": gV(gI("tipo_cor"))
		}
	};
	request("POST", dv_gateway + "/cores", "", data, "controllerResponse", true, getCookie(gz_project));
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
				"label": "cor",
				"type": "input",
				"id": "cor",
				"class": "dv-required"
			}
		],
		[
			{
				"label": "hexadecimal",
				"type": "input",
				"id": "hexadecimal",
				"class": "dv-required"
			}
		],
		[
			{
				"label": "tipo_cor",
				"type": "select",
				"id": "tipo_cor",
				"class": "dv-required",
				"options": [
					{
						"value": 1,
						"content": "tipo_cor 1"
					},
					{
						"value": 2,
						"content": "tipo_cor 2"
					}
				]
			}
		]
	]
}