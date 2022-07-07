function foo() {
	let data = {
		"id": gV(gI("id")),
		"tipo_menu": gV(gI("tipo_menu"))
	};
	request("POST", dv_gateway + "/tipos_menus", "", data, "controllerResponse", true, getCookie(gz_project));
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
				"label": "tipo_menu",
				"type": "input",
				"id": "tipo_menu",
				"class": "dv-required"
			}
		]
	]
}