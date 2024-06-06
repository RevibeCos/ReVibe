import { Badge } from "@/shadcn/ui/badge";
import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from "@/shadcn/ui/card";
import { ThemeSelector } from "@/Components/header/partials/theme-selector";
import { Button, Icon } from "@/shadcn";
import Test from "./Test";
import LanguageSelector from "@/Components/header/partials/LanguageSelector";
import { useTranslation } from "react-i18next";
import { HeaderWrapper } from "@/Components/header/header-wrapper";
import AppLayout from "@/Layouts/app-wrapper";

const i18nNamespaces = ["home"];

export default function Home() {
    const { t, i18n } = useTranslation(i18nNamespaces);
    const isRTL = i18n.dir() === "rtl";
    return (
        <>
            <div className="flex flex-row mt-16 mx-16 gap-x-6 ">
                <ThemeSelector />
                <LanguageSelector />
                <Badge className="mb-2" variant="outline">
                    Badge
                </Badge>
            </div>
            <Card className="w-[30%] mx-auto">
                <CardHeader>
                    <CardTitle>Card Title</CardTitle>
                    <CardDescription>Card Description</CardDescription>
                </CardHeader>
                <CardContent>
                    <p>Card Content</p>
                </CardContent>
                <CardFooter>
                    <p>Card Footer</p>
                </CardFooter>
            </Card>
            <div className="flex flex-col gap-y-8 mx-auto max-w-[150px] mt-4">
                <Button variant="ghost">ghost</Button>
                <Button variant="destructive">destructive</Button>
                <Button variant="default">default</Button>
                <Button variant="link">link</Button>
                <Button variant="outline">outline</Button>
                <Button variant="secondary">secondary</Button>
            </div>
            <div>
                <Icon
                    name="search"
                    className=" h-4 w-4 text-muted-foreground"
                />
            </div>
        </>
    );
}

Home.layout = (page: any) => (
    <AppLayout i18nNamespaces={i18nNamespaces} 
    children={page} />
);
