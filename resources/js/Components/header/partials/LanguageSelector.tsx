import { useState } from "react"; // Import useState hook
import { DropdownMenu, Icon } from "@/shadcn";
import { bake_cookie } from "sfcookies";
import { useTranslation } from "react-i18next";
import { Check } from "lucide-react";
import { router } from "@inertiajs/react";

const LanguageSelector = () => {
    const { i18n } = useTranslation();
    const handleLangChange = (locale: string) => {
        bake_cookie("x-current-lang", locale);
        router.get(window.location.href);
    };

    return (
        <DropdownMenu.Root icon={<Icon name="languages" />}>
            <DropdownMenu.Item
                className="flex items-center capitalize"
                onClick={() => handleLangChange("en")}
            >
                English
                <Check
                    className={`h-4 w-4 ml-auto ${
                        i18n.language === "en"
                            ? "text-primary"
                            : "text-transparent"
                    }`}
                />
            </DropdownMenu.Item>
            <DropdownMenu.Item
                className="flex items-center capitalize"
                onClick={() => handleLangChange("ar")}
            >
                عربي
                <Check
                    className={`h-4 w-4 ml-auto ${
                        i18n.language === "ar"
                            ? "text-primary"
                            : "text-transparent"
                    }`}
                />
            </DropdownMenu.Item>
        </DropdownMenu.Root>
    );
};

export default LanguageSelector;
