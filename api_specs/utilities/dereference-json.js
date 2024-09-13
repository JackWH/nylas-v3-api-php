import { readFile, writeFile } from 'fs/promises';
import $RefParser from "@apidevtools/json-schema-ref-parser";

let administrationSchema = JSON.parse(await readFile("api_specs/yaml/administration.yaml.json", "utf8"));
let emailCalendarSchema = JSON.parse(await readFile("api_specs/yaml/email-calendar.yaml.json", "utf8"));
let schedulerSchema = JSON.parse(await readFile("api_specs/yaml/scheduler.yaml.json", "utf8"));

try {
    await $RefParser.dereference(administrationSchema);
    await writeFile("api_specs/administration.json", JSON.stringify(administrationSchema, null, 2));
    console.info('administration.json done!');

    await $RefParser.dereference(emailCalendarSchema);
    await writeFile("api_specs/email-calendar.json", JSON.stringify(emailCalendarSchema, null, 2));
    console.info('email-calendar.json done!');

    await $RefParser.dereference(schedulerSchema);
    await writeFile("api_specs/scheduler.json", JSON.stringify(schedulerSchema, null, 2));
    console.info('scheduler.json done!');
} catch (err) {
    console.error(err);
}

console.log('Done!');
