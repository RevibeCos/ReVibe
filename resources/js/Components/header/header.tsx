import { useTranslation } from "react-i18next";
import LanguageSelector from "./partials/LanguageSelector";
import { ThemeSelector } from "./partials/theme-selector";
import { usePage } from "@inertiajs/react";
const Header = () => {
    const { t, i18n } = useTranslation(['home']);
    const isRTL = i18n.dir() === "rtl";

    const {component,props} = usePage();
    console.log("🚀 ~ Header ~ props:", props)

    return (
        <header
            className="bg-card z-10 sticky top-0"
            lang={i18n.language}
            dir={i18n.dir()}
        >
            <div className="flex flex-col items-center">
                <div className=" border-b w-full">
                    <div className="max-w-[1536px] mx-auto flex flex-row items-center justify-between py-2 ">
                        <p className="font-tajawal-light text-sm">
                            Whatsapp Number:+00972599043747
                        </p>
                        <div className="flex flex-row items-start gap-x-2">
                            <ThemeSelector />
                            <LanguageSelector />
                        </div>
                    </div>
                </div>
                <div className="border-b w-full">
                    <div className="max-w-[1536px] mx-auto flex flex-row items-center justify-between  ">
                        <div className="flex flex-row basis-5/6 border-r ">
                            <p>xxx</p>
                        </div>
                        <div className="flex flex-row basis-1/6 border-r ">
                            <p>xxxx</p>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    );
};

export default Header;
