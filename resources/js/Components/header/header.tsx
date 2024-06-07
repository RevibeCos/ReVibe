import { useTranslation } from "react-i18next";
import LanguageSelector from "./partials/LanguageSelector";
import { ThemeSelector } from "./partials/theme-selector";
import { Link, usePage } from "@inertiajs/react";
import { Button, Input, Icon } from "@/shadcn";
import { constants } from "@/constants/cloudinary";
const Header = () => {
    const { t, i18n } = useTranslation(["home"]);
    const isRTL = i18n.dir() === "rtl";

    const { component, props } = usePage();
    console.log("🚀 ~ Header ~ props:", props);

    return (
        <header
            className="bg-card z-10 sticky top-0"
            lang={i18n.language}
            dir={i18n.dir()}
        >
            <div className="flex flex-col items-center">
                <div className=" border-b w-full">
                    <div className="max-w-[1536px] mx-auto flex flex-row items-center justify-between py-2 ">
                        <p className="font-tajawal-light text-base">
                            Whatsapp Number : +00972599043747
                        </p>
                        <div className="flex flex-row items-start gap-x-2">
                            <ThemeSelector />
                            <LanguageSelector />
                        </div>
                    </div>
                </div>
            </div>
            <div className="border-b w-full">
                <div className="max-w-[1536px] mx-auto flex flex-row items-center justify-between  ">
                    <div className="flex flex-row items-center  basis-5/6 border-r py-2">
                        <div className="flex flex-row basis-2/6">
                            <Link href="/">
                                <img src={constants.website_logo} />
                            </Link>
                        </div>
                        <div className="flex flex-row basis-4/6">
                            <div className="flex gap-2 basis-1/3 justify-center">
                                <div className="relative flex-1 md:grow-0">
                                    <Icon
                                        name="search"
                                        className="absolute left-2.5 top-2.5 h-4 w-4 text-muted-foreground"
                                    />
                                    <Input
                                        type="search"
                                        placeholder="Search..."
                                        className="w-full rounded-lg bg-background pl-8 md:w-[200px] lg:w-[400px]"
                                    />
                                </div>
                                <Button variant="outline">Search</Button>
                            </div>
                        </div>
                    </div>
                    <div className="flex flex-row items-center justify-center gap-x-2 basis-1/6 border-r py-4 h-32 ">
                        <Icon name="user-round" />
                        <Icon name="heart" />
                        <Icon name="shopping-cart" />
                    </div>
                </div>
            </div>
        </header>
    );
};

export default Header;
