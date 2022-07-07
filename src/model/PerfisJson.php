function foo() {
	let data = {
		"id": gV(gI("id")),
		"perfil": gV(gI("perfil"))
	};
	request("POST", dv_gateway + "/perfis", "", data, "controllerResponse", true, getCookie(gz_project));
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
				"type": "input",
				"id": "perfil",
				"class": "dv-required"
			}
		]
	]
}