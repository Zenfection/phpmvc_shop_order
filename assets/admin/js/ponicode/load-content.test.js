const rewire = require("rewire")
const load_content = rewire("../load-content")
const loadCity = load_content.__get__("loadCity")
// @ponicode
describe("loadCity", () => {
    test("0", () => {
        document.body.insertAdjacentHTML("afterbegin", `<div id="wrapper0"><div>
        	<div id="province"></div>
        	<div id="city"></div>
        </div>
        </div>`)
        let result = loadCity()
        expect(result).toMatchSnapshot()
        expect(document.getElementById("wrapper0")).to.matchSnapshot()
        document.body.removeChild(document.getElementById("wrapper0"))
    })
})
