// ���� ifdef ���Ǵ���ʹ�� DLL �������򵥵�
// ��ı�׼�������� DLL �е������ļ��������������϶���� NOVELWRITER_EXPORTS
// ���ű���ġ���ʹ�ô� DLL ��
// �κ�������Ŀ�ϲ�Ӧ����˷��š�������Դ�ļ��а������ļ����κ�������Ŀ���Ὣ
// NOVELWRITER_API ������Ϊ�Ǵ� DLL ����ģ����� DLL ���ô˺궨���
// ������Ϊ�Ǳ������ġ�
#ifdef NOVELWRITER_EXPORTS
#define NOVELWRITER_API __declspec(dllexport)
#else
#define NOVELWRITER_API __declspec(dllimport)
#endif

// �����Ǵ� NovelWriter.dll ������
class NOVELWRITER_API CNovelWriter {
public:
	CNovelWriter(void);
	// TODO:  �ڴ��������ķ�����
};

extern NOVELWRITER_API int nNovelWriter;

NOVELWRITER_API int fnNovelWriter(void);