export class ApiConnector {
    constructor() {

    }

    static buildLink(endpoint) {
        var href = window.location.origin;
        return href + endpoint;
    }

    static get(endpoint) {
        return new Promise((resolve, reject) => axios
            .get(this.buildLink(endpoint))
            .then(
                result => {
                    console.log(result)
                    resolve(result.data)
                }
            ).catch(error => {
                console.log("Error in get to " + endpoint);
                console.log(error);
                reject(error)
            }));
    }

    static getExternal(endpoint) {
        return new Promise((resolve, reject) => axios
            .get(endpoint)
            .then(
                result => {
                    resolve(result.data)
                }
            ).catch(error => {
                console.log("Error in get to " + endpoint);
                console.log(error);
                reject(error)
            }));
    }

    static post(endpoint, data) {
        return new Promise((resolve, reject) => axios
            .post(this.buildLink(endpoint), data)
            .then(
                result => {
                    resolve(result.data)
                }
            ).catch(error => {
                console.log("Error in POST to " + endpoint);
                console.log(error);
                reject(error)
            }))
    }

    static getPage(id) {
        return this.get("/api/page.php?page_id=" + id)
    }

    static getProgram(id) {
        if (id != null && id != undefined) {
            return this.get("/api/event.php?event_id=" + id);
        }

        return this.get("/api/event.php");
    }

    static getNav() {
        return this.get("/api/navigation.php");
    }

    static getGlobals() {
        return this.get("/api/globals.php")
    }

    static getSocials() {
        return this.get("/api/socials.php")
    }

    static postContact(data) {
        return this.post("/api/contact.php", data)
    }

    static getGames() {
        return this.getExternal("https://conservices.de/api/event/d726a499-96d2-4d1d-aa62-5cfee3871951/game")
    }
}