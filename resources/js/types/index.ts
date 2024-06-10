const translationMap: { [key: string]: () => Promise<any> } = {
    "en:home": () => import("@/locales/en/home.json"),
    "ar:home": () => import("@/locales/ar/home.json"),
    "en:welcome": () => import("@/locales/en/welcome.json"),
    "ar:welcome": () => import("@/locales/ar/welcome.json"),
    "en:header": () => import("@/locales/en/header.json"),
    "ar:header": () => import("@/locales/ar/header.json"),

    // Add other language-namespace combinations here
};

export default translationMap;
