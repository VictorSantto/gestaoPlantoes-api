function foo() {
	let data = {
		"id": gV(gI("id")),
		"perfisInput": {
			"id": gV(gI("perfil"))
		},
		"tipos_permissoesInput": {
			"id": gV(gI("tipo_permissao"))
		},
		"telasInput": {
			"id": gV(gI("tela"))
		}
	};
	request("POST", dv_gateway + "/perfil_tela", "", data, "controllerResponse", true, getCookie(gz_project));
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
				"label": "perfil",
				"type": "select",
				"id": "perfil",
				"class": "dv-required",
				"options": [
					{
						"value": 1,
						"content": "perfil 1"
					},
					{
						"value": 2,
						"content": "perfil 2"
					}
				]
			}
		],
		[
			{
				"label": "tipo_permissao",
				"type": "select",
				"id": "tipo_permissao",
				"class": "dv-required",
				"options": [
					{
						"value": 1,
						"content": "tipo_permissao 1"
					},
					{
						"value": 2,
						"content": "tipo_permissao 2"
					}
				]
			}
		],
		[
			{
				"label": "tela",
				"type": "select",
				"id": "tela",
				"class": "dv-required",
				"options": [
					{
						"value": 1,
						"content": "tela 1"
					},
					{
						"value": 2,
						"content": "tela 2"
					}
				]
			}
		]
	]
}