function foo() {
	let data = {
		"id": gV(gI("id")),
		"tipo_cor": gV(gI("tipo_cor"))
	};
	request("POST", dv_gateway + "/tipos_cores", "", data, "controllerResponse", true, getCookie(gz_project));
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
				"label": "tipo_cor",
				"type": "input",
				"id": "tipo_cor",
				"class": "dv-required"
			}
		]
	]
}