import { Moon, Sun, Check } from "lucide-react";
import { DropdownMenu } from "@/shadcn";
import { useTheme } from "@/providers/theme-provider";
type Theme = "light" | "dark" | "system";
export function ThemeSelector() {
    const { setTheme, theme } = useTheme();
    const themes: Theme[] = ["light", "dark", "system"];
    return (
        <DropdownMenu.Root icon={theme === "light" ? <Sun /> : <Moon />}>
            {themes.map((t) => (
                <DropdownMenu.Item
                    key={t}
                    onClick={() => setTheme(t)}
                    className="flex items-center capitalize"
                >
                    {t}
                    <Check
                        className={`h-4 w-4 ml-auto ${
                            theme === t ? "text-primary" : "text-transparent"
                        }`}
                    />
                </DropdownMenu.Item>
            ))}
        </DropdownMenu.Root>
    );
}
