import { useEffect, useState } from "react";
import { getLocal } from "@/utils/getLocal";
import { Resource, i18n as I18nInstance } from "i18next";

export const useTranslations = (namespaces: string[]) => {
  const [translations, setTranslations] = useState<{
    i18n: I18nInstance;
    resources: Resource;
  } | null>(null);
  const [error, setError] = useState<string | null>(null);

  const loadTranslations = async () => {
    try {
      const result = await getLocal(namespaces);
      setTranslations(result);
    } catch (error) {
      console.error("Error loading translations:", error);
      setError("Failed to load translations");
    }
  };

  useEffect(() => {
    loadTranslations();
  }, [namespaces]);

  return { translations, error };
};
